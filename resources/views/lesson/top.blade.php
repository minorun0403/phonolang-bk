<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レッスントップ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-md mx-auto space-y-6">

        @foreach ($lessons as $lesson)
            <div class="lesson-item cursor-pointer flex items-start space-x-4 {{ $lesson['status'] === 'locked' ? 'opacity-70' : '' }}">
                <div class="w-12 h-12 bg-teal-300 rounded-lg flex items-center justify-center text-white text-xl">
                    {{ $lesson['icon'] }}
                </div>
                <div class="flex-1">
                    <p class="font-semibold">{{ $lesson['title'] }}</p>

                    @if ($lesson['status'] === 'completed')
                        <p class="text-teal-500 font-semibold">
                            Completed!🌟
                        </p>
                    @elseif ($lesson['status'] === 'in_progress')
                        <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                            <div class="h-2 bg-teal-400 rounded-full" style="width: {{ $lesson['progress'] }}%"></div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $lesson['progress_label'] }}</p>
                    @elseif ($lesson['status'] === 'locked')
                        <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                            <div class="h-2 bg-teal-400 rounded-full" style="width: 0%"></div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $lesson['progress_label'] }}</p>
                    @endif
                </div>
            </div>

            {{-- 詳細表示（最初は非表示） --}}
            <div class="lesson-details hidden ml-16 mt-2 text-sm text-gray-600">
                <form action="{{ route('lesson.detail') }}" method="POST">
                    @csrf
                    <ul>
                        <li>
                            <button type="submit" name="selected_lesson" value="レッスン1" class="block py-1 text-left w-full hover:underline">
                                レッスン詳細 1
                            </button>
                        </li>
                        <li>
                            <button type="submit" name="selected_lesson" value="レッスン2" class="block py-1 text-left w-full hover:underline">
                                レッスン詳細 2
                            </button>
                        </li>
                        <li>
                            <button type="submit" name="selected_lesson" value="レッスン3" class="block py-1 text-left w-full hover:underline">
                                レッスン詳細 3
                            </button>
                        </li>
                    </ul>
                </form>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lessonItems = document.querySelectorAll('.lesson-item');

            lessonItems.forEach(item => {
                item.addEventListener('click', function () {
                    const details = item.nextElementSibling;
                    if (details && details.classList.contains('lesson-details')) {
                        details.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>
