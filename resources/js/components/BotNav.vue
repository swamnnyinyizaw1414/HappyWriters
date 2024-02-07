<template>
    <div class="container d-lg-none">
        <div class="row justify-content-center">
            <div class="col-10 d-flex justify-content-center">
                <div class="d-flex justify-content-around align-items-center w-100 px-5 py-2 bg-white border-top position-fixed bottom-0">
                    <Link href="/" class="text-decoration-none text-secondary ">
                        <i class="bi bi-house-door" :class="{ 'active-bot-nav': pathname === '/' && !goToAdditionalPart }" style="font-size: 1.2rem;"></i>
                    </Link>
                    <i v-if="pathname==='/'" class="bi bi-award" :class="{'text-black' : goToAdditionalPart}" @click="handleAdditionalPart" style="font-size: 1.2rem; color: grey;"></i>
                    <Link href="/blog/create" class="mx-2 text-decoration-none text-secondary">
                        <i class="bi bi-pencil-square" :class="{ 'active-bot-nav': pathname === '/blog/create' }" style="font-size: 1.2rem;"></i>
                    </Link>
                    <div v-if="username" class="">
                        <div v-if="!currentUserProfilePicture" data-bs-toggle="modal" data-bs-target="#profilePart" style="width: 25px; height: 25px; border-radius: 50%;" class="mx-2 btn btn-outline-dark d-flex justify-content-center align-items-center ">
                            <h5 class="mb-0">{{ username.slice(0, 1) }}</h5>
                        </div>
                        <img v-else :src="'/storage/'+currentUserProfilePicture" data-bs-toggle="modal" data-bs-target="#profilePart" style="width:25px; height:25px; border-radius: 50%;" class="user-profile mx-2" alt="">
                    </div>
                    <Link v-else href="/redirect" class="text-decoration-none text-secondary ">
                        <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage,Link } from '@inertiajs/vue3';
import {ref,computed} from 'vue';

    let page=usePage()
    let pathname= ref(page.url)

    let emit=defineEmits(['hasAdditionalPart'])

    let username=computed(()=>{
        return page.props.auth.user.username;
    });

    let currentUserProfilePicture=computed(()=>{
        // console.log(page.props.auth.user.currentUserProfilePicture)
        return page.props.auth.user.currentUserProfilePicture;
    })

    let goToAdditionalPart=ref(false)

    let handleAdditionalPart=()=>{
        // console.log('hit')
        goToAdditionalPart.value=true
        emit('hasAdditionalPart',true)
    }

</script>

<style>

.active-bot-nav{
    color: #000;
}

</style>