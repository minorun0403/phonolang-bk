<div class="space-y-4" id="answer-content" data-is_correct="{{ $is_correct }}" data-user_answer="{{ $user_answer }}">
    @foreach($choices as $index => $choice)
        <div class="relative">
        <input type="radio" id="choice{{ $index }}" name="answer" value="{{ $index }}" class="hidden peer">
        <label for="choice{{ $index }}"  class="block cursor-pointer p-4 border-2 border-gray-300 rounded-lg shadow-lg">
                <p class="text-lg text-center">{{ $choice }}</p>
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
        let is_correct = $("#answer-content").data("is_correct");
        let user_answer = $("#answer-content").data("user_answer");

        $("#answer-content input").each(function () {
            let choice = $(this);
            let label = choice.next("label");

            if (choice.val() == user_answer) {
                if (is_correct) {
                    label.addClass("bg-green-200 border-green-500"); // 正解:
                } else {
                    label.addClass("bg-red-200 border-red-500"); // 不正解: 赤
                }
            } else {
                label.addClass("opacity-50"); // 選ばれていない選択肢をグレーアウト
            }
        });
    });

    document.getElementById('next-button').addEventListener('click', function () {
        window.location.href = "{{ route('lesson.entrypoint') }}";
    });
</script>
