<div class="flex justify-center">
    <div class="w-full max-w-6xl pt-8">

        {{-- 新規追加ボタン --}}
        <button class="btn btn-primary" onclick="create_modal.showModal()">新規追加</button>

        {{-- モーダル --}}
        <dialog id="create_modal" class="modal">
            <div class="modal-box">
                <button onclick="create_modal.close()" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                <h3 class="text-lg font-bold">メッセージの入力</h3>

                {{-- フォーム --}}
                <form wire:submit='storePost'>
                    <p class="py-4">
                        <textarea wire:model='message' name="message" placeholder="メッセージを入力してください" class="textarea textarea-bordered textarea-md w-full max-w-lg"></textarea>
                    </p>
                    <div class="flex justify-between">
                        <button onclick="create_modal.close()" type="button" class="btn btn-ghost">キャンセル</button>
                        <button onclick="create_modal.close()" target="storePost" type="submit" class="btn btn-primary">送信</button>
                    </div>
                </form>

            </div>
            <div onclick="create_modal.close()" class="modal-backdrop"></div>
        </dialog>

        {{-- メッセージ一覧 --}}
        <div class="mt-8">
            <div class="overflow-x-auto">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>メッセージ</th>
                            <th>作成日時</th>
                            <th>更新日時</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="hover">
                                <td>{{ $post->message }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
