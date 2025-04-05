<div class="space-y-4" id="answer-content" data-correct="{{ json_encode($correct) }}" data-useranswer="{{ $userAnswer }}">
    <div class="relative">
        <input type="radio" id="choice1" name="answer" value="リンゴ" class="hidden peer">
        <label for="choice1" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-hover:bg-blue-50answer-content">
            <p class="text-lg">リンゴ</p>
        </label>
    </div>

    <div class="relative">
        <input type="radio" id="choice2" name="answer" value="バナナ" class="hidden peer">
        <label for="choice2" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-hover:bg-blue-50answer-content">
            <p class="text-lg">バナナ</p>
        </label>
    </div>

    <div class="relative">
        <input type="radio" id="choice3" name="answer" value="オレンジ" class="hidden peer">
        <label for="choice3" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-hover:bg-blue-50answer-content">
            <p class="text-lg">オレンジ</p>
        </label>
    </div>

    <div class="relative">
        <input type="radio" id="choice4" name="answer" value="メロン" class="hidden peer">
        <label for="choice4" class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-hover:bg-blue-50answer-content">
            <p class="text-lg">メロン</p>
        </label>
    </div>
    <button id="submit-answer" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600answer-content">回答する</button>
</div>

<script>
$(document).ready(function () {
    let correct = $("#answer-content").data("correct");
    let userAnswer = $("#answer-content").data("useranswer");

    $("#answer-content input").each(function () {
        let choice = $(this);
        let label = choice.next("label");

        // すべての選択肢のスタイルをリセット
        label.removeClass("bg-green-200 border-green-500 bg-red-200 border-red-500 opacity-50");

        if (choice.val() === userAnswer) {
            // ユーザーが選んだ選択肢をハイライト
            if (correct) {
                label.addClass("bg-green-200 border-green-500"); // 正解: 緑
            } else {
                label.addClass("bg-red-200 border-red-500"); // 不正解: 赤
            }
        } else {
            label.addClass("opacity-50"); // 選ばれていない選択肢をグレーアウト
        }
    });
});
</script>
