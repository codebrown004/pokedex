<template>

<div class="row mt-3">
    <div class="col-12 text-right">
        <input type="text" name="" v-model="search" class="form-control col-3 d-inline" placeholder="Type Pokemon" id="">
        <button class="btn btn-danger mb-1" @click="loadStatePokemon(search)">Search</button>
    </div>
    <div v-if="loading">
        <center>
            <h1>
                <div class="spinner-border text-danger" role="status">
                    <span class="sr-only"></span></div> Loading...
            </h1>
            </center>
    </div>
    <div v-else class="card w-16 h-10 my-1 mr-2 text-center" v-for="pokemon in pokemonList" :key="pokemon.id" >
        <div class="card-header text-white">{{pokemon.name}}</div>
        <div class="card-body">
        <img class="card-img-top" :src="pokemon.img_url" alt="Card image cap" width="25" height="100">
 
        <p class="card-text">{{pokemon.type}}</p>
        </div>
        <div class="card-footer text-white">
            <span class="fa fa-star" @click="sendReaction(pokemon.id,'favorite')"></span>
            <span class="fa fa-thumbs-up" @click="sendReaction(pokemon.id, 'like')"></span>
            <span class="fa fa-thumbs-down"  @click="sendReaction(pokemon.id, 'hate')"></span>
        </div>
    </div>
    <div>
        <div v-if="notif" class="alert" :class="error_msg ? 'alert-danger': 'alert-success'">
		    {{ message }} &nbsp;
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		   <span aria-hidden="true">&times;</span>
		</button>
	</div>
    </div>
</div>
</template>

<style scoped>
    .card-header,.card-footer{
        /* text-align: center; */
        font-size: 25px;
        background-color: #DF1818;
    }
    .card-footer span{
        padding-right: 9px;
    }
    span:hover{
        color: #039BE5;
    }
    div.alert {
        right: 0;
        bottom: 0;
        position: fixed;
    }
</style>

<script>
    export default {
        data () {
            return {
                pokemonList: [],
                loading: true,
                notif: false,
                message: '',
                error_msg: false,
                search: ''
            }
        },
        methods: {
            async loadStatePokemon(pokemon)
            {
                
                axios
                .get(`https://pokeapi.co/api/v2/pokemon/${pokemon}`)
                .then(result => {
                    const data = result.data;
                    // if(this.pokemonList.some(pokemon => pokemon.id === data.id))
                    // {
                    //     this.pokemonList = [];
                    // }
                    this.pokemonList.push(
                        {
                            id: data.id, 
                            name: data.name , 
                            img_url : data.sprites['front_default'],
                            type: data.types.map((type) => type.type.name).join(', ')
                        });
                }).catch((error) => {
                    console.log(error);
                });
            },
            async sendReaction(id, reaction)
            {
                const data = this.pokemonList.find(pokemon => pokemon.id === id);
                const request = {
                    id: data.id,
                    pokemon: data.name,
                    image: data.img_url,
                    react: reaction
                }
                axios
                .post('/adToPokedex', request)
                .then(result => {
                    this.notif = true;
                    if(result.data.error)
                    {
                        this.error_msg = true;
                        this.message = result.data.error
                    }
                    else
                    {
                        this.message = result.data.success
                        this.error_msg = false;
                    }
                    // this.notif = false;

                    

                    console.log(result);
                }).catch((error) => {
                    console.log(error);
                });
            }
        },
        mounted() {
            var _this = this;
            axios
            .get('https://pokeapi.co/api/v2/pokemon/')
            .then(response => {
                response.data.results.map(function(value, key) {
                   _this.loadStatePokemon(value.name);
                });
            _this.loading = false;
            })
            .catch((error) => {
                    console.log(error);
            });
        }

    }

</script>
