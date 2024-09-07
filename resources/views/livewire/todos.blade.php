<div x-data="{ message: 'Hello, Alpine.js!', items: ['item1', 'item2', 'item3'] }">
    <span x-text="message"></span>
    <input type="text" x-model="message">
    <ul>
        <template x-for="item in items">
            <li x-text="item"></li>
        </template>
    </ul>
</div>
