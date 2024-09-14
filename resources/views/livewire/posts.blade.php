<div x-data="{ openCreateModal: false, openEditModal: false, openDeleteModal: false, openShowModal: false }" class="flex justify-center">
    <div class="w-full max-w-6xl pt-8">

        <div class="flex justify-between">
            {{-- 新規追加ボタン --}}
            <button class="btn btn-primary" x-on:click="openCreateModal = true">新規追加</button>

            {{-- 検索フォーム --}}
            <label wire:model.live.debounce.500ms='search' class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                </svg>
                <input type="text" class="grow" placeholder="検索" />
            </label>

        </div>

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
                            <tr wire:key="post-{{ $post->id }}" class="hover">
                                <td> <a x-on:click="$wire.editPost('{{ $post->id }}'); openShowModal = true;" class="link">{{ $post->message }}</a></td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>{{ $post->updated_at->diffForHumans() }}</td>

                                {{-- メニュー --}}
                                <td>
                                    @if ($post->user_id === auth()->user()->id)
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
                                                    <a x-on:click="$wire.editPost('{{ $post->id }}'); openDeleteModal = true;" class="text-error">
                                                        <svg class="w-4" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                                        </svg>
                                                        削除
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="py-8">
            {{ $posts->links() }}
        </div>

        {{-- Create Modal --}}
        <div x-show="openCreateModal" x-on:post-saved.window="openCreateModal = false" style="display: none" x-on:keydown.escape.prevent.stop="openCreateModal = false; $wire.resetFormValidation(); $wire.message = '';" role="dialog" aria-modal="true" class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="openCreateModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div x-show="openCreateModal" x-transition x-on:click="openCreateModal = false; $wire.resetFormValidation(); $wire.message = '';" class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="openCreateModal" class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-8 shadow-lg">
                    <button x-on:click="openCreateModal = false; $wire.resetFormValidation(); $wire.message = '';" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                    <h3 class="text-lg font-bold mb-4">メッセージの追加</h3>

                    <!-- Form -->
                    <form wire:submit='storePost'>

                        {{-- ファイルアップロード --}}
                        <input wire:model="photo" accept="image/*" type="file" class="file-input file-input-bordered w-full max-w-md" />
                        @error('photo')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <p class="py-4">
                            <textarea wire:model='message' name="message" placeholder="メッセージを入力してください" class="textarea textarea-bordered textarea-md w-full max-w-lg"></textarea>
                            @error('message')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </p>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <button type="button" x-on:click="openCreateModal = false; $wire.resetFormValidation(); $wire.message = '';" class="btn btn-ghost">
                                キャンセル
                            </button>
                            <button type="submit" class="btn btn-primary">
                                追加
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="openEditModal" style="display: none" x-on:post-updated.window="openEditModal = false" x-on:keydown.escape.prevent.stop="openEditModal = false" role="dialog" aria-modal="true" class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="openEditModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div x-show="openEditModal" x-transition x-on:click="openEditModal = false; $wire.resetFormValidation(); $wire.current_message = '';" class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="openEditModal" class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-8 shadow-lg">
                    <button x-on:click="openEditModal = false; $wire.resetFormValidation(); $wire.current_message = '';" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                    <h3 class="text-lg font-bold">メッセージの編集</h3>

                    <!-- Form -->
                    <form wire:submit='updatePost'>
                        <p class="py-4">
                            <textarea wire:model='current_message' name="current_message" placeholder="メッセージを入力してください" class="textarea textarea-bordered textarea-md w-full max-w-lg"></textarea>
                            @error('current_message')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </p>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <button type="button" x-on:click="openEditModal = false; $wire.resetFormValidation(); $wire.current_message = '';" class="btn btn-ghost">
                                キャンセル
                            </button>

                            <button type="submit" class="btn btn-primary">
                                編集
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <!-- Delete Modal -->
        <div x-show="openDeleteModal" style="display: none" x-on:keydown.escape.prevent.stop="openDeleteModal = false" role="dialog" aria-modal="true" class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="openDeleteModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div x-show="openDeleteModal" x-transition x-on:click="openDeleteModal = false" class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="openDeleteModal" class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-8 shadow-lg">
                    <button x-on:click="openDeleteModal = false" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4">✕</button>
                    <h3 class="text-lg font-bold">メッセージの削除</h3>

                    <!-- Form -->
                    <form wire:submit='deletePost'>
                        <p wire:poll='current_message' class="p-4 w-full max-w-lg">{{ $current_message }}</p>

                        <!-- Buttons -->
                        <div class="flex justify-between">
                            <button type="button" x-on:click="openDeleteModal = false" class="btn btn-ghost">
                                キャンセル
                            </button>

                            <button type="submit" x-on:click="openDeleteModal = false" class="btn btn-error">
                                削除
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <!-- Show Modal -->
        <div x-show="openShowModal" style="display: none" x-on:post-updated.window="openShowModal = false" x-on:keydown.escape.prevent.stop="openShowModal = false" role="dialog" aria-modal="true" class="fixed inset-0 z-10 overflow-y-auto">
            <!-- Overlay -->
            <div x-show="openShowModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div x-show="openShowModal" x-transition x-on:click="openShowModal = false;" class="relative flex min-h-screen items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="openShowModal" class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-8 shadow-lg">
                    <button x-on:click="openShowModal = false;" class="btn btn-sm btn-circle btn-ghost focus:outline-none absolute right-4 top-4">✕</button>
                    <h3 class="text-lg font-bold">メッセージ</h3>

                    <!-- Image -->
                    @if ($current_photo_path)
                        <figure>
                            <img src="{{ asset($current_photo_path) }}">
                        </figure>
                    @endif

                    <!-- Content -->
                    <div>
                        <p class="py-4">
                            {{ $current_message }}
                        </p>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
