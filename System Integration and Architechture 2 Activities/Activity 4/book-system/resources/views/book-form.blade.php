<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request to Borrow | Digital Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        frost: {
                            50: '#fdfcff',  
                            100: '#f3f0ff', 
                            200: '#e0d9ff', 
                            300: '#c7baff', 
                            400: '#a78bfa', 
                            500: '#7c3aed', /* Enhanced: More vibrant primary purple */
                            600: '#6d28d9', /* Enhanced: Deeper hover purple */
                        },
                    },
                    borderRadius: {
                        '4xl': '2rem',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f7ff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(124, 58, 237, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(167, 139, 250, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        input, select, textarea {
            transition: all 0.2s ease-in-out !important;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="bg-white shadow-[0_20px_50px_rgba(124,58,237,0.12)] rounded-3xl w-full max-w-4xl border border-frost-100 flex flex-col md:flex-row overflow-hidden">
        
        <div class="md:w-5/12 bg-frost-100 p-8 flex flex-col justify-between border-r border-frost-200">
            <div>
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center border border-frost-200">
                        <span class="text-2xl">📖</span>
                    </div>
                    <div class="leading-tight">
                        <span class="text-lg font-bold text-gray-900">Digital</span>
                        <span class="text-lg font-medium text-frost-500">Library</span>
                    </div>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-950 leading-tight tracking-tighter mb-4">
                    Your next <span class="text-frost-500 italic">CHAPTER</span>  awaits.
                </h1>
                <p class="text-gray-600 text-sm font-normal mb-8 leading-relaxed italic border-l-2 border-frost-300 pl-4">
                   “Books open your mind, broaden your mind, and strengthen you as nothing else can." - William Feather
                </p>
            </div>

            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-frost-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-frost-200">
                    ✨
                </div>
                <div>
                    <div class="text-2xl font-extrabold text-gray-950">98%</div>
                    <div class="text-xs text-gray-500 uppercase font-bold tracking-wider">Approval Rate</div>
                </div>
            </div>
        </div>

        <div class="md:w-7/12 p-8 md:p-10 bg-white">
            
            <div class="mb-8">
                <div class="text-[10px] font-bold text-frost-500 uppercase tracking-[0.2em] mb-1">Library</div>
                <h2 class="text-2xl font-extrabold text-gray-950 tracking-tight">Borrowing Request Form</h2>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-900 p-4 rounded-2xl mb-6 flex items-start gap-3 shadow-sm">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-emerald-500 flex items-center justify-center text-white text-sm font-bold">✓</div>
                    <div>
                        <p class="font-bold text-sm">Request Received!</p>
                        <p class="text-xs text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-950 p-4 rounded-2xl mb-6 flex items-start gap-3 shadow-sm">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-red-500 flex items-center justify-center text-white text-sm font-bold">✕</div>
                    <div>
                        <p class="font-bold text-sm">Please check your input.</p>
                        <p class="text-xs text-red-800">Ensure all required fields are complete and valid.</p>
                    </div>
                </div>
            @endif

            <form action="/borrow-book" method="POST" class="space-y-5">
                @csrf

                @php
                    $inputStyle = "w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:border-frost-400 focus:ring-4 focus:ring-frost-100 focus:bg-white outline-none";
                    $labelStyle = "block text-xs font-bold text-gray-700 mb-1.5 pl-1 uppercase tracking-wide";
                    $errorStyle = "text-red-600 text-[11px] mt-1.5 font-semibold pl-1";
                @endphp

                <div>
                    <label for="borrower_name" class="{{ $labelStyle }}">Full Name</label>
                    <input type="text" name="borrower_name" id="borrower_name" value="{{ old('borrower_name') }}" 
                        placeholder="Surname/First Name/ Middle Initial"
                        class="{{ $inputStyle }} @error('borrower_name') border-red-200 bg-red-50 @enderror">
                    @error('borrower_name') <p class="{{ $errorStyle }}">Required. 5-100 characters.</p> @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="book_title" class="{{ $labelStyle }}">Book Title</label>
                        <input type="text" name="book_title" id="book_title" value="{{ old('book_title') }}" 
                            class="{{ $inputStyle }}">
                    </div>
                    <div>
                        <label for="isbn" class="{{ $labelStyle }}">ISBN-13</label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" 
                            placeholder="13-digit number"
                            class="{{ $inputStyle }}">
                        @error('isbn') <p class="{{ $errorStyle }}">Must be 13 digits.</p> @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="borrow_days" class="{{ $labelStyle }}">Duration (Days)</label>
                        <input type="number" name="borrow_days" id="borrow_days" value="{{ old('borrow_days') }}" 
                            min="1" max="14"
                            class="{{ $inputStyle }}">
                    </div>
                    <div>
                        <label for="membership" class="{{ $labelStyle }}">Membership Status</label>
                        <div class="relative">
                            <select name="membership" id="membership" 
                                class="{{ $inputStyle }} appearance-none bg-no-repeat bg-[right_1rem_center]">
                                <option value="" disabled {{ old('membership') ? '' : 'selected' }}>Select Status</option>
                                <option value="student" {{ old('membership') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="faculty" {{ old('membership') == 'faculty' ? 'selected' : '' }}>Faculty / Staff</option>
                                <option value="guest" {{ old('membership') == 'guest' ? 'selected' : '' }}>Visiting Guest</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-frost-500 text-xs">
                                ▼
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="notes" class="{{ $labelStyle }}">Additional Information</label>
                    <textarea name="notes" id="notes" rows="2" 
                        placeholder="Any special instructions..."
                        class="{{ $inputStyle }} resize-none">{{ old('notes') }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-frost-500 hover:bg-frost-600 text-white font-bold py-4 rounded-xl transition duration-300 shadow-md shadow-frost-200 text-sm flex items-center justify-center gap-2">
                        SUBMIT REQUEST
                        <span class="text-lg">→</span>
                    </button>
                    <p class="text-center text-[10px] text-gray-400 mt-4 leading-relaxed">
                        Requests are processed within 24 hours.
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>