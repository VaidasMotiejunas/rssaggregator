<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- NAVBAR -->
                <nav class="navbar navbar-dark bg-dark">
                    <span class="navbar-brand mb-0 h1">Rss reader</span>
                    <form class="form-inline">
                        <button @click="toggleShowFilter()" class="btn btn-outline-success" type="button">Filter Channels</button>
                    </form>
                </nav>

            </div>
            <div v-if="showFilter" class="col-sm-12">
                <!-- FILTER CARD -->
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Filter channels by category</h5>
                        <div class="card-text">
                            <!-- SELECT FORM -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <select v-model="selectedCat" class="form-control" id="exampleFormControlSelect1">
                                            <option value='none'>Show all</option>
                                            <option v-for="category in allCats" :key="category.id" :value="category">{{upperFirstLetter(category)}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button @click="toggleShowFilter(); sortFeed()" type="submit" class="btn btn-outline-success">Filter</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
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
                selectedCat: 'none',
                allCats: [],
                showFilter: false,
            }
        },

        mounted() {
            // after mount sets all categories
            this.setAllCats();
        },

        methods: {

            /**
             * Sets all categories data variable
             */
            setAllCats() {
                for (var key in this.feed) {
                    if(!this.feed.hasOwnProperty(key)) continue;
                    var channel = this.feed[key];
                    channel.category.forEach(cat => {
                        if(this.allCats.indexOf(cat) === -1)
                        {
                            this.allCats.push(cat);
                        }
                    });
                }

            },

            /**
             * toggles filter div visability
             */
            toggleShowFilter() {
                this.showFilter = !this.showFilter;
            },

            /**
             * Sends selected category to backend
             * if success updates feed by response data
             */
            sortFeed() {
                axios.post('/sortFeed', {
                    category: this.selectedCat,
                })
                .then(function (response) {
                    this.feed = response.data;
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
            },

            /**
             * Capitalizes first || all category letters
             */
            upperFirstLetter(name) {
                if(name == 'it')
                {
                    return name.toUpperCase();
                }
                return name.charAt(0).toUpperCase()+name.slice(1);
            }

        },


    }
</script>
