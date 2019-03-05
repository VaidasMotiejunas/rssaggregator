<template>
<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-10">
                    <a :href="channel.permalink" target="blank">{{channel.title}}</a>
                </div>
                <div class="col-sm-2">
                    <div v-if="showFeed">
                        <button @click="toggleFeed()" type="button" class="btn btn-primary">hide</button>
                    </div>
                    <div v-else>
                        <button @click="toggleFeed()" type="button" class="btn btn-primary">show</button>
                    </div>
                </div>
            </div>
        </div>
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
        toggleFeed() {
            this.showFeed = !this.showFeed;
        },
        showModal(feed) {
            EventBus.$emit('show-modal', feed);
        }
    }
}
</script>

