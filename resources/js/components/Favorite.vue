<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(model)" class="btn btn-dark mb-3" style="width: 150px;">
            
            <i class="bi bi-heart-fill" style="font-size: 16px;"> Unfavorite</i>
        </a>
        <a href="#" v-else @click.prevent="favorite(model)" class="btn btn-dark mb-3" style="width: 150px; ">
           <i class="bi bi-heart" style="font-size: 16px;"> Favorite</i>
        </a>

    </span>
</template>

<script>
    export default {
        props: ['model', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(model) {
                axios.post('/favorite/'+model)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(model) {
                axios.post('/unfavorite/'+model)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>