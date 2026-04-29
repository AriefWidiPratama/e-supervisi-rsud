<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        .bg-wave {
            background: linear-gradient(180deg, #004e92 0%, #000428 100%);
        }
        .btn-gradient {
            background: linear-gradient(180deg, #0072ff 0%, #0056b3 100%);
        }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-white min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <div class="bg-wave pt-24 pb-16 relative">
            <h1 class="text-3xl font-black text-white text-center leading-snug tracking-wide relative z-10 px-6">
                APLIKASI<br>SUPERVISI KLINIK<br>PERAWAT
            </h1>
            
            <svg class="absolute bottom-0 w-full text-white" viewBox="0 0 1440 320" fill="currentColor" preserveAspectRatio="none" style="height: 60px;">
                <path d="M0,160L80,170.7C160,181,320,203,480,192C640,181,800,139,960,133.3C1120,128,1280,160,1360,176L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>

        <div class="px-8 pt-6 flex-1 bg-white relative z-10">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border-2 border-gray-200 p-4 rounded-md outline-none focus:border-blue-500 transition-colors text-gray-700 font-medium" 
                        placeholder="Username / Email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input id="password" type="password" name="password" required 
                        class="w-full border-2 border-gray-200 p-4 rounded-md outline-none focus:border-blue-500 transition-colors text-gray-700 font-medium" 
                        placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-gradient hover:opacity-90 text-white font-bold text-lg py-4 rounded-md shadow-lg transition-opacity">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
        
        <div class="absolute bottom-0 w-full opacity-30 pointer-events-none">
             <svg viewBox="0 0 1440 320" fill="#0072ff"><path d="M0,256L120,229.3C240,203,480,149,720,154.7C960,160,1200,224,1320,256L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
        </div>

    </div>

</body>
</html>