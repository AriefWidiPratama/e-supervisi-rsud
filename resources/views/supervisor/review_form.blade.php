<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Review | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-review { background: radial-gradient(circle at top right, #f5f3ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-review min-h-screen pb-12 p-6">
    <main class="max-w-2xl mx-auto">
        <header class="mb-8 flex justify-between items-center">
            <a href="{{ route('supervisor.dashboard') }}" class="text-slate-400 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div class="text-right">
                <h1 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600">Verification Process</h1>
                <p class="text-xl font-extrabold text-slate-900 leading-tight">Review Clinical Report</p>
            </div>
        </header>

        <div class="glass-card p-8 rounded-[2.5rem] shadow-xl shadow-indigo-900/5 mb-8 border-l-8 border-l-indigo-600">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Performing Nurse</p>
                    <p class="font-bold text-slate-800">{{ $education->user->name }}</p>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Patient Code</p>
                    <p class="font-bold text-slate-800">{{ $education->patient->patient_code }}</p>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-100 flex justify-between">
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Education Media</p>
                    <span class="text-[10px] font-bold bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full border border-indigo-100 uppercase">{{ $education->used_media }}</span>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Reported Scores</p>
                    <p class="text-xs font-bold text-slate-600 uppercase">Diet: {{ $education->diet_score }}% | Act: {{ $education->activity_score }}%</p>
                </div>
            </div>
        </div>

        <form action="{{ route('supervisor.review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="education_id" value="{{ $education->id }}">

            <div class="space-y-6">
                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50">
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wide italic leading-none">Supervision Score</h3>
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Nurse's interaction quality</p>
                    </div>
                    
                    <input type="range" name="observation_score" min="0" max="100" value="0" 
                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                           oninput="this.nextElementSibling.value = this.value + '/100'">
                    <output class="block text-center mt-4 text-4xl font-black text-indigo-600">0/100</output>
                </div>

                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50">
                    <h3 class="font-black text-slate-900 text-sm uppercase tracking-wide mb-4 italic">Clinical Feedback</h3>
                    <textarea name="feedback" rows="4" 
                              class="w-full bg-white/50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all font-bold text-slate-800 placeholder:font-medium resize-none" 
                              placeholder="Provide follow-up plan or clinical notes..." required></textarea>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-black py-5 rounded-[2rem] shadow-2xl shadow-slate-200 hover:shadow-indigo-200 transition-all duration-300 text-sm uppercase tracking-[0.2em]">
                    Finalize Supervision
                </button>
            </div>
        </form>
    </main>
</body>
</html>