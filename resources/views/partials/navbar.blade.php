<nav class="bg-gray-800 p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-white font-semibold text-xl">
            <a href="{{ route('dashboard') }}">Home</a>
        </div>
        <div class="space-x-4">
            <a href="{{ route('coverletter.upload') }}" class="text-gray-300 hover:text-white">Upload Cover Letter</a>
            <a href="{{ route('resume.index') }}" class="text-gray-300 hover:text-white">Resumes</a>
        </div>
    </div>
</nav>