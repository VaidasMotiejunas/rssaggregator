import Vue from 'vue';
import Vuex from 'vuex';
// import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({

    // element state
    state: {
        feed: [],
    },

    // Tiesiogiai keicia state
    mutations: {
        changeFeed (state, feed) {
            state.feed = feed;
        },
    },

    // Iskviecia mutators
    actions: {
        // Set all element fields
        setFeed ({commit}, feed) {
            commit('changeFeed', feed);
        },
    },

    // Grazina state. Galima state variables apdoroti pvz filter
    /**
     * Returns state.
     * It's like computed property in vue.
     */
    getters: {
        getFeed: state => state.feed,
    }

});

export default store;