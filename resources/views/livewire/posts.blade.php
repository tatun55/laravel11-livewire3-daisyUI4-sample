<div class="flex justify-center">
    <div class="w-full max-w-6xl pt-8">

        {{-- 新規追加ボタン --}}
        <button class="btn btn-primary" onclick="create_modal.showModal()">新規追加</button>

        {{-- モーダル --}}
        <dialog id="create_modal" class="modal">
            <div class="modal-box">
                <button onclick="create_modal.close()" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                <h3 class="text-lg font-bold">メッセージの入力</h3>
                <p class="py-4">
                    <textarea name="message" placeholder="メッセージを入力してください" class="textarea textarea-bordered textarea-md w-full max-w-lg"></textarea>
                </p>
                <div class="flex justify-between">
                    <button onclick="create_modal.close()" class="btn btn-ghost">キャンセル</button>
                    <button class="btn btn-primary">送信</button>
                </div>
            </div>
            <div onclick="create_modal.close()" class="modal-backdrop"></div>
        </dialog>

    </div>
</div>
