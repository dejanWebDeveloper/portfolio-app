@if(session()->has('system_message'))
    <div class="alert alert-success text-indigo-400" role="alert">
        {{session()->pull('system_message')}}
    </div>
@endif
<form action="{{route('send_email')}}" method="post" id="email-form" class="flex flex-col gap-6 bg-gray-900 p-8 rounded-2xl shadow-lg commenting-form">
    @csrf
    <div>
        <div>
            <label for="name" class="block mb-2 font-medium text-gray-300">Name</label>
            <input name="name" type="text" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border
            border-gray-700 focus:outline-none focus:border-indigo-500 form-control @error('name') is-invalid @enderror"
                   placeholder="Enter Your Name" value="{{old('name')}}">
            <div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div>
            <label for="email" class="block mb-2 font-medium text-gray-300 mt-2">Email</label>
            <input name="email" type="email" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border
            border-gray-700 focus:outline-none focus:border-indigo-500 form-control @error('email') is-invalid @enderror"
                   placeholder="Enter Email Address (will not be published)" value="{{old('email')}}">
            <div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div>
            <label for="message" class="block mb-2 font-medium text-gray-300 mt-2">Message</label>
            <textarea name="message" id="" rows="10"
                      class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-100 border border-gray-700
                      focus:outline-none focus:border-indigo-500 form-control @error('message') is-invalid @enderror"
                      placeholder="Type Your Message">{{old('message')}}</textarea>
            <div>
                @error('message')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('g-recaptcha-response')
                <div class="alert alert-danger">{{ $errors->first('g-recaptcha-response') }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-12">
            <button type="submit" value="Send Message" class="mt-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3
            rounded-full transition-all duration-300btn g-recaptcha"
                    data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"
                    data-callback='onSubmit'
                    data-action='submit'>Submit Your Message
            </button>
        </div>

    </div>
</form>

@push('footer_script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#email-form').validate({
                "rules": {
                    "name": {
                        "required": true,
                        "minlength": 2,
                        "maxlength": 30
                    },
                    "email": {
                        "required": true,
                        "email": true
                    },
                    "message": {
                        "required": true,
                        "minlength": 5,
                        "maxlength": 500
                    }
                },
                "messages": {
                    "name": {
                        "required": "Please enter your name",
                        "minlength": "Your name must be over 2 characters",
                        "maxlength": "Enter no more than 30 characters"
                    },
                    "email": {
                        "required": "Your email adress must be provided",
                        "email": "Enter valid email adress"
                    },
                    "message": {
                        "required": "What do you want to say to us",
                        "minlength": "Your message must be longer than 5 characters",
                        "maxlength": "Your message cannot be longer than 500 characters"
                    }
                },
                "errorClass": "is-invalid"
            });
        });
        //system-message disappear after 2s
        document.addEventListener('DOMContentLoaded', function () {
            const msg = document.getElementById('system-message');
            if(msg){
                setTimeout(() => {
                    msg.style.transition = "opacity 0.5s ease";
                    msg.style.opacity = 0;
                    setTimeout(() => msg.remove(), 500);
                }, 2000);
            }
        });
    </script>
@endpush
@push('recaptcha')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("email-form").submit();
        }
    </script>
@endpush
