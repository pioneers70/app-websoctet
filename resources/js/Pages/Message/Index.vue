<script>
export default {
    name: "index",
    props: [
        'messages',
    ],
    data() {
        return {
            body: ''
        }
    },
    created() {
        window.Echo.channel('store_message')
            .listen('.store_message', res => {
                this.messages.unshift(res.message)
            });
    },
    methods: {
        store() {
            axios.post('/messages', {body: this.body})
                .then(res => {
                    this.messages.unshift(res.data)
                    this.body = ''
                })
        }
    }
}
</script>

<template>
    <div class="w-1/2 mx-auto py-6">
        <div>
            <div>
                <input type="text" v-model="body" class="rounded-full border border-gray-400"
                       placeholder="Type a message...">
            </div>
            <div>
                <a @click.prevent="store" href="#"
                   class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2 mt-3">Send</a>
            </div>
        </div>
        <div v-if="messages.length > 0" class="mb-3 mt-6">
            <h3>Messages</h3>
            <div class="pt-4">
                <div class="text-sm  pb-2 mb-2 border-b border-gray-200" v-for="message in messages">
                    <p>{{ message.id }}</p>
                    <p>{{ message.body }}</p>
                    <p class="text-center">{{ message.time }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
