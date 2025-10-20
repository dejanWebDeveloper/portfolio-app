<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class PhotoService
{
    public function save($photo, $model, $field, $path = 'photo/author/')
    {
        $photoName = $model->id . '_' . $field . '_' . Str::uuid() . '.jpg';
        $relativePath = $path . $photoName;

        if (!empty($model->$field)) {
            $this->delete($model, $field, $path);
        }

        $image = Image::read($photo)
            ->cover(256, 256)
            ->toJpeg(90);

        Storage::disk('public')->put($relativePath, (string)$image);

        $model->$field = $photoName;
        $model->save();
    }

    public function delete($model, $field, $path = 'photo/author/')
    {
        if (empty($model->$field)) return;

        $filePath = $path . $model->$field;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $model->$field = null;
        $model->save();
    }

    public function saveProjectPhoto($photo, $project, $field)
    {
        // Generate unique filenames
        $baseName = $project->id . '_' . $field . '_' . Str::uuid();
        $extension = $photo->getClientOriginalExtension();

        $photoName = $baseName . '.' . $extension;
        $photoThumbName = $baseName . '_thumb.' . $extension;

        // Delete old photo + thumb if they exist
        if ($project->$field) {
            $oldPath = 'photo/' . $project->$field;
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        if ($project->additional_photo) {
            $oldThumbPath = 'photo/' . $project->additional_photo;
            if (Storage::disk('public')->exists($oldThumbPath)) {
                Storage::disk('public')->delete($oldThumbPath);
            }
        }

        // Save normal photo
        $photo->storeAs('photo', $photoName, 'public');

        // Create + save thumbnail
        $thumbPath = 'photo/' . $photoThumbName;
        $image = Image::read($photo)
            ->cover(256, 256)   // crop + resize
            ->toJpeg(90);       // compress
        Storage::disk('public')->put($thumbPath, (string)$image);

        // Update DB with relative paths
        $project->$field = $photoName;
        $project->additional_photo = $photoThumbName;
        $project->save();
    }

    public function deleteProjectPhoto($project, $field)
    {
        if (!$project->$field) {
            return false;
        }

        // Delete main photo
        $path = 'photo/' . $project->$field;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        // Delete thumbnail if exists
        if ($project->additional_photo) {
            $thumbPath = 'photo/' . $project->additional_photo;
            if (Storage::disk('public')->exists($thumbPath)) {
                Storage::disk('public')->delete($thumbPath);
            }
        }

        // Clear DB fields
        $project->$field = null;
        $project->additional_photo = null;
        $project->save();

        return true;
    }
    public function saveUserPhoto($photo, $user, $field)
    {
        // Generate unique filename
        $photoName = $user->id . '_' . $field . '_' . Str::uuid();
        $relativePath = 'photo/user/' . $photoName;
        // Delete old photo if exists
        if (!empty($user->$field)) {
            $oldPath = 'photo/user/' . $user->$field;
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        // Read + crop + resize + encode
        $image = Image::read($photo)
            ->cover(256, 256)
            ->toJpeg(90);
        // Save new photo to storage
        Storage::disk('public')->put($relativePath, (string) $image);
        // Update DB (store only filename if you prefer)
        $user->$field = $photoName;
        $user->save();
    }

    public function deleteUserPhoto($user, $field)
    {
        if (!$user->$field) return false;
        $path = 'photo/user/' . $user->$field;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        $user->$field = null;
        $user->save();
        return true;
    }
}
