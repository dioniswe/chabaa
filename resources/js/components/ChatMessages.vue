<template>
    <div class="chat_area" id="chat_area">
        <ul class="list-unstyled">
            <li class="left clearfix" v-for="message in messages">
                <div class="chat-body clearfix ">
                    <div class="row border rounded ">
                        <div class="col-sm-3 border rounded-left">
                            {{ message.user.introduced_name }}
                        </div>
                        <div class="col-sm-9 border rounded-right">
                            {{ message.message }}
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['messages', 'channelPrefix'],
        beforeMount() {
            this.$emit('messageinitialize', {});
        },
        created() {
            var channelPrefix = $("#church-service").data('channel-prefix');
            window.Echo.channel(channelPrefix + 'message-received-event')
                .listen('MessageReceivedEvent', (e) => {
                    this.$parent.$refs.messageFrame.messages.push(e.message);
                });
        },
        updated() {
            $('#chat_area').get(0).scrollTop = $('#chat_area').get(0).scrollHeight;
        }
    };
</script>