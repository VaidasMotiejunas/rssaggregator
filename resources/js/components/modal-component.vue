<template>
    <!-- MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ feed.title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ feed.description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a :href="feed.link" target="blank" role="button" class="btn btn-primary">Go to feed page</a>
            </div>
            </div>
        </div>
    </div>
</template>

<script>

import { EventBus } from '../event/event-bus';

    export default {
        data() {
            return {
                feed: [],
            }
        },

        mounted() {

            /**
             * Listens for global show-modal event(from chanel-component)
             */
            EventBus.$on('show-modal', (payload) => {

            /**
             * Calls setFeed method after mount
             */
            this.setFeed(payload);
            });

        },

        methods: {
            /**
             * Populates modal element with required feed data
             */
            setFeed(feed) {
                this.feed = feed;
            }
        }
        
    }
</script>

