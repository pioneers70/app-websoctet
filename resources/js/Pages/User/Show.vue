<script>
export default {
    name: "Show",
    props: [
        'user'
    ],
    data() {
        return {
            like_str: ''
        }
    },
    created() {
        window.Echo.private(`send_like_${this.$page.props.auth.user.id}`)
            .listen('.send_like', res => {
                this.like_str = res.like_str
            })
    },
    methods: {
        sendLike() {
            axios.post(`/users/${this.user.id}`, {from_id: this.$page.props.auth.user.id})
                .then(res => {
                        this.like_str = res.data.like_str
                    }
                )
        }
    }
}
</script>

<template>
    <div class="p-6 mt-4 w-1/3 mx-auto">
        <div class="mb-4">
            User {{ user.name }}
        </div>
        <div class="mb-4">
            <a @click.prevent="sendLike" href="#"
               class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2 mt-3">Отправить</a>
        </div>
        <div v-if="like_str">
            {{ like_str }}
        </div>

    </div>
</template>

<style scoped>

</style>
