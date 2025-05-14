<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>英語の方言クイズ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex-1 max-w-4xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg min-h-[90vh]">
            <div class="mb-6 text-center">
                <p class="text-lg">{{ $question_no }}問目 正答率：{{ $correct_rate ?? 0 }}%</p>
                <div class="w-full bg-gray-200 rounded-full h-2.5 my-4 relative">
                    <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                </div>
                <p class="text-xl font-bold mb-2">{{ $question }}</p>
                <p class="text-gray-600 mb-6">この単語の意味はどれ？</p>
            </div>

            <div id="lesson-content" class="space-y-4">
                @foreach($choices as $id => $word)
                    <div class="relative">
                        <input type="radio" id="choice{{ $id }}" name="answer" value="{{ $id }}" class="hidden peer">
                        <label for="choice{{ $id }}" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">
                            <p class="text-lg text-center">{{ $word }}</p>
                        </label>
                    </div>
                @endforeach

                <div class="flex justify-between p-3">
                    <button id="skip-button" class="question-action bg-gray-300 text-gray-700 w-[150px] h-[50px] p-3 mt-5 rounded hover:bg-gray-400">戻る</button>
                    <button id="answer-button" class="question-action bg-[#FB9CB5] text-white w-[150px] h-[50px] p-3 mt-5 rounded hover:bg-[#F4CAC8]">回答する</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.question-action', function() {
            let user_answer = $("input[name='answer']:checked").val();

            $.post(`/lesson/word-rev/answer`, {
                _token: '{{ csrf_token() }}',
                user_answer: user_answer,
                word_id: '{{ $word_id }}',
                choices: @json($choices),
            }, function(data) {
                $('#lesson-content').html(data.html);
            });
        });
    </script>
</body>
</html>
