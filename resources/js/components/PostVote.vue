<template>


                    <div class="btn-group-vertical">

                        <btton class="btn" >
                            <span class="btn btn-outline-primary" @click="voteUp" :class="{'btn-info': didVoteUp}" :disabled="!isAuthenticated" >+</span>
                        </btton>

                        <btton class="btn">{{  totalVotes }} </btton>

                        <btton class="btn" >
                            <span class="btn btn-outline-primary" @click="voteDown" :class="{'btn-info': didVoteDown}" :disabled="!isAuthenticated" >-</span>
                        </btton>

                    </div>

</template>

<script>

    const VOTE_UP =1;
    const VOTE_DOWN =-1;
    const NO_VOTE =0;

export default{


    props:{
        isAuthenticated:{
            type: Boolean,
        },
        postId: {
            type: Number,
        },
        currentVotes:{
            type:Number,
            default:NO_VOTE

    },
    userVote:{
            type:Number,
            default:NO_VOTE
        }
    },

    data(){
       return{

           internalUserVote:VOTE_DOWN,

            internalCurrentVotes: 0,

       }
    },

    computed:{
         didVoteUp(){

             return this.internalUserVote===VOTE_UP;

         },

         didVoteDown(){

             return this.internalUserVote===VOTE_DOWN;

         },
         totalVotes(){

             return this.internalCurrentVotes + this.internalUserVote;
         }

     },

        methods: {

         voteUp(){

           this.vote(1);
         console.log('vote up');
     },
        voteDown(){

            this.vote(-1);
            console.log('vote down');

    },
        vote(vote){

            if(!this.isAuthenticated){
                return;
            }
            if(this.internalUserVote === vote){

                this.internalUserVote =NO_VOTE;

            }else{

                this.internalUserVote=vote;
            }

            axios.post(`/posts/vote/${this.postId}`,
                        {vote: this.internalUserVote})

            .then((response)=> {

            })
            .catch(err => {

            });
        }
    },
    mounted(){
        this.internalUserVote=this.userVote;
        this.internalCurrentVotes = this.currentVotes - this.internalUserVote;
    }

}

</script>
