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
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">英語の方言クイズ</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="hover:underline">ホーム</a></li>
                    <li><a href="#" class="hover:underline">クイズ一覧</a></li>
                    <li><a href="#" class="hover:underline">設定</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="flex min-h-screen">
        <div class="flex-1 max-w-4xl mx-auto p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg min-h-[90vh]">
                <h2 class="text-3xl font-semibold text-center mb-4">クイズ</h2>

                <!-- 問題番号、正解数、正解率 -->
                <div class="mb-6 text-center">
                    <p class="text-lg">{{$question_no}}問目</p>
                    <p class="text-sm text-gray-600">正解数: 3 / 10　　正解率: 30%</p>
                    <div class="border-t border-gray-300 my-4"></div>
                </div>
                
                <div id="lesson-content">
                    <!-- クイズの単語 -->
                    <div class="text-center mb-6">
                        <p class="text-xl font-bold mb-2">apple</p>
                        <p class="text-gray-600">この単語の意味はどれ？</p>
                    </div>

                    <!-- 選択肢 -->
                    <div class="space-y-4">
                        <!-- 1つ目の選択肢 -->
                        <div class="relative">
                            <input type="radio" id="choice1" name="answer" value="リンゴ" class="hidden peer">
                            <label for="choice1" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">
                                <p class="text-lg">リンゴ</p>
                            </label>
                        </div>
                        
                        <!-- 2つ目の選択肢 -->
                        <div class="relative">
                            <input type="radio" id="choice2" name="answer" value="バナナ" class="hidden peer">
                            <label for="choice2" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">
                                <p class="text-lg">バナナ</p>
                            </label>
                        </div>
                        
                        <!-- 3つ目の選択肢 -->
                        <div class="relative">
                            <input type="radio" id="choice3" name="answer" value="オレンジ" class="hidden peer">
                            <label for="choice3" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">
                                <p class="text-lg">オレンジ</p>
                            </label>
                        </div>
                        
                        <!-- 4つ目の選択肢 -->
                        <div class="relative">
                            <input type="radio" id="choice4" name="answer" value="メロン" class="hidden peer">
                            <label for="choice4" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-checked:bg-blue-100 peer-checked:border-blue-500 hover:bg-blue-50 transition">
                                <p class="text-lg">メロン</p>
                            </label>
                        </div>
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
            let lessonId = $(this).data('lesson_id');
            let questionNo = $(this).data('question_no');
            let selectedAnswer = $("input[name='answer']:checked").val();
        
            $.post(`/lesson/${lessonId}/answer/${questionNo}`, {
                _token: '{{ csrf_token() }}',
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
