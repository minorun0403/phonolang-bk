<div class="space-y-4" id="answer-content" data-correct="{{ json_encode($correct) }}" data-useranswer="{{ $userAnswer }}">
    @foreach($question_word_meanings as $index => $meaning)
        <div class="relative">
        <input type="radio" id="choice{{ $index + 1 }}" name="answer" value="{{ $meaning }}" class="hidden peer">
        <label for="choice{{ $index + 1 }}"  class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg peer-hover:bg-blue-50answer-content">
                <p class="text-lg">{{ $meaning }}</p>
            </label>
        </div>
    @endforeach
    <div class="flex justify-end">
        <button id="next-button" class="next-action bg-[#FB9CB5] text-white w-[150px] h-[50px] p-3 mt-5 rounded hover:bg-[#F4CAC8]">
            次の問題
        </button>
    </div>
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

    document.getElementById('next-button').addEventListener('click', function () {
        // Laravelのroute関数でURLを埋め込む
        window.location.href = "{{ route('lesson.entrypoint') }}";
    });
</script>