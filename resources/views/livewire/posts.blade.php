<div class="flex justify-center">
    <div class="w-full max-w-6xl pt-8">

        {{-- 新規追加ボタン --}}
        <button class="btn btn-primary" onclick="create_modal.showModal()">新規追加</button>

        {{-- モーダル --}}
        <dialog id="create_modal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">タイトル</h3>
                <p class="py-4">コンテント</p>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
</div>
