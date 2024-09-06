<div x-data="{ openEditModal: false }" class="flex justify-center">
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
            <div class="overflow-show">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>メッセージ</th>
                            <th>作成日時</th>
                            <th>更新日時</th>
                            <th>メニュー</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="hover">
                                <td>{{ $post->message }}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>{{ $post->updated_at->diffForHumans() }}</td>

                                {{-- メニュー --}}
                                <td>
                                    <div class="dropdown dropdown-end">
                                        <div tabindex="0" role="button" class="btn btn-sm btn-square m-1">
                                            <svg class="w-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
                                            </svg>
                                        </div>
                                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-28 p-2 shadow text-center">
                                            <li>
                                                <a x-on:click="$wire.editPost('{{ $post->id }}'); openEditModal = true;" class="text-success">
                                                    <svg class="w-4" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                                                    </svg>
                                                    編集
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-error">
                                                    <svg class="w-4" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                                    </svg>
                                                    削除
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="openEditModal" style="display: none" x-on:keydown.escape.prevent.stop="openEditModal = false" role="dialog" aria-modal="true" class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="openEditModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div x-show="openEditModal" x-transition x-on:click="openEditModal = false" class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="openEditModal" class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-8 shadow-lg">
                    <button x-on:click="openEditModal = false" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                    <h3 class="text-lg font-bold">メッセージの編集</h3>

                    <!-- Form -->
                    <form wire:submit='updatePost'>
                        <p class="py-4">
                            <textarea wire:model='message' name="message" placeholder="メッセージを入力してください" class="textarea textarea-bordered textarea-md w-full max-w-lg"></textarea>
                        </p>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <button type="button" x-on:click="openEditModal = false" class="btn btn-ghost">
                                キャンセル
                            </button>

                            <button type="submit" x-on:click="openEditModal = false" class="btn btn-primary">
                                編集
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
