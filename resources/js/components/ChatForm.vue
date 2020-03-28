<template>
    <div class="message_write">
        <div class="row">
        <div class=" col-9">
        <textarea id="btn-input" name="message" class="form-control input-sm"
                  placeholder="Hier kannst du deine Nachricht eingeben..." v-model="newMessage"
                  > </textarea>
        </div>
        <div class="col-3">
            <a href="#" class="float-right btn btn-success" @click="sendMessage">
                Send</a>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: null
            }
        },
        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            },
        },
    }
</script>