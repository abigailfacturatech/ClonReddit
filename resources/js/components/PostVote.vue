<template>
  <div class="form-group">
   <div class="col-md-1">

                    <div class="btn-group-vertical">

                        <btton class="btn">
                            <span class="btn btn-outline-primary" @click="voteUp" :class="{'btn-info':didVoteUp}">+</span>
                        </btton>

                        <btton class="btn">{{ totalVotes }}</btton>

                        <btton class="btn">
                            <span class="btn btn-outline-primary" @click="voteDon" :class="{'btn-info':didVoteDown}">-</span>
                        </btton>

                    </div>
                </div>
</div>
</template>

<script>

    const VOTE_UP =1;
    const VOTE_DOWN =-1;
    const NO_VOTE =0;

export default{

    props:{
        currentVotes:{
            type:Number,
            default:NO_VOTE
        }
    },

    userVote:{
        type:Number,
        default:NO_VOTE
    }
,


    data(){
       return{

           internalUserVote:0

       }
    },

    Computed:{
        didVoteUp(){

            return this.internalUserVote===VOTE_UP;

        },

        didVoteDown(){

            return this.internalUserVote===VOTE_DOWN;

        },
        totalVotes(){
            return this.currentVotes + internalUserVote;
        }

    },


     methods: {

         voteUp(){

            this.vote(VOTE_UP);

         },

        voteDon(){
            this.vote(VOTE_DOWN);
        },

        vote(vote){

            if(this.internalUserVote ===vote){

                    this.internalUserVote =NO_VOTE;

            }else{
                 this.internalUserVote =vote;
                }
              }
            },

    mounte(){
        this.internalUserVote=this.userVote;
    }

}

</script>
