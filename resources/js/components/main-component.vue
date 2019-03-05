<template>
    <div class="container">
        <!-- <div class="row justify-content-center"> -->
        <div class="row">
            <div class="col-sm-12">
                <div v-for="(channel) in this.feed" :key="channel.id">
                    <channel-component 
                        :channel="channel"
                        v-on:show-modal="showModal($event)"
                    >
                    </channel-component>
                </div>
            </div>
        </div>
        <modal-component></modal-component>
    </div>
</template>

<script>

    export default {

        props: ['data'],

        data() {
            return {
                feed: this.data,
            }
        },

    }
</script>
