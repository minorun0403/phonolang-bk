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
    <header class="bg-blue-600 text-white p-4">

    </header>

    <div class="flex min-h-screen">
        <div class="flex-1 max-w-4xl mx-auto p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg min-h-[90vh]">

                <!-- 問題番号、正解数、正解率 -->
                <div class="mb-6 text-center">
                    <p class="text-lg">{{$question_no}}問目 正答率：{{ $correctRate ?? 0 }}%</p>

                <div class="relative pt-1">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                    </div>
                    <div class="border-t border-gray-300 my-4"></div>
                </div>

                <div class="text-center mb-6">
                    <p class="text-xl font-bold mb-2">{{$question_word}}</p>
                    <p class="text-gray-600">この単語の意味はどれ？</p>
                </div>

                <div id="lesson-content">
                    <!-- 選択肢 -->
                    <div class="space-y-4">
                        @foreach($meanings as $index => $meaning)
                            <div class="relative">
                            <input type="radio" id="choice{{ $index }}" name="answer" value="{{ $index }}" class="hidden peer">
                            <label for="choice{{ $index }}"  class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">                            
                                    <p class="text-lg">{{ $meaning }}</p>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between p-3">
                        <button button id="skip-button" class="question-action bg-gray-300 text-gray-700 w-[150px] h-[50px] p-3 mt-5 rounded hover:bg-gray-400">戻る</button>
                        <button button id="answer-button" class="question-action bg-[#FB9CB5] text-white w-[150px] h-[50px] p-3 mt-5 rounded hover:bg-[#F4CAC8]">回答する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.question-action', function() {
            let selectedAnswer = $("input[name='answer']:checked").val();

            $.post(`/lesson/word/answer`, {
                _token: '{{ csrf_token() }}',
                correct: '{{ $word_question_id }}',
                meanings: @json($meanings),
                answer: selectedAnswer
            }, function(data) {
                // サーバーからのレスポンスを処理
                if (data.finished) {
                    alert('Lesson completed!');
                } else {
                    $('#lesson-content').html(data.html);
                }
            });
        });
    </script>
</body>
</html>
