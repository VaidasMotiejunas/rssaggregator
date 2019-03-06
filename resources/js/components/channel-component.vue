<template>
    <!-- CHANNEL CARD -->
    <div class="card">
        <!-- CHANNEL DATA -->
        <div class="card-header">
            <div class="row">
                <div class="col-md-10 col-lg-11">
                    <a :href="channel.permalink" target="blank">{{channel.title}}</a>
                </div>
                <div class="col-md-2 col-lg-1">
                    <div v-if="showFeed">
                        <button @click="toggleFeed()" type="button" class="btn btn-primary">hide</button>
                    </div>
                    <div v-else>
                        <button @click="toggleFeed()" type="button" class="btn btn-primary">show</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FEED DATA -->
        <div v-show="showFeed">
            <ul class="list-group list-group-flush">
                <button @click="showModal(feed)" type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#exampleModal" 
                    v-for="(feed) in channel.items" 
                    :key="feed.id"
                >
                    {{feed.title}}
                </button>
            </ul>
        </div>

    </div>
</template>

<script>

import { EventBus } from '../event/event-bus';

export default {
    props: ['channel'],

    data() {
        return {
            showFeed: false,
        }
    },

    methods: {
        /**
         * Toggles feed div visability
         */
        toggleFeed() {
            this.showFeed = !this.showFeed;
        },
        /**
         * Emits global event show-modal
         */
        showModal(feed) {
            EventBus.$emit('show-modal', feed);
        }
    }
}
</script>

