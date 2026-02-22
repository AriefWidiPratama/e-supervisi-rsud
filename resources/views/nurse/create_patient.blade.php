<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-gradient-main {
            background: radial-gradient(circle at top right, #e0e7ff 0%, #f8fafc 50%);
        }
    </style>
</head>
<body class="bg-gradient-main min-h-screen flex flex-col items-center justify-center p-6">
    
    <div class="max-w-md w-full">
        <div class="mb-8 text-center">
            <h1 class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-blue-600 mb-2">Subject Registration</h1>
            <p class="text-2xl font-black text-slate-900">Add Research Patient</p>
        </div>

        <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl shadow-blue-900/10">
            <form method="POST" action="{{ route('perawat.patient.store') }}">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Patient Code</label>
                        <input type="text" name="patient_code" 
                               class="w-full bg-white/50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all font-bold text-slate-800 placeholder:font-medium" 
                               placeholder="e.g. JNT-001" required>
                        @error('patient_code')
                            <p class="text-red-500 text-[10px] mt-2 font-bold uppercase ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Medical Diagnosis</label>
                        <textarea name="medical_diagnosis" rows="4" 
                                  class="w-full bg-white/50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all font-bold text-slate-800 placeholder:font-medium resize-none" 
                                  placeholder="Describe the diagnosis..." required></textarea>
                    </div>

                    <div class="pt-4 space-y-3">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-blue-200 transition-all duration-300 text-sm uppercase tracking-widest">
                            Save Subject Data
                        </button>
                        
                        <a href="{{ route('perawat.dashboard') }}" class="block text-center w-full bg-transparent text-slate-400 hover:text-slate-600 font-bold py-2 text-[10px] uppercase tracking-widest transition-all">
                            Cancel & Go Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-[9px] text-slate-300 font-bold uppercase tracking-[0.2em]">E-Supervisi Data Entry System</p>
    </footer>

</body>
</html>