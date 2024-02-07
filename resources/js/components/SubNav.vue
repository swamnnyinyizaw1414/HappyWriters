<template>
   <div v-if="username" class="sub-nav mb-3 px-3 px-sm-4 px-lg-2">
        <div class="d-flex py-3 sub-nav-container align-items-center">
            <Link href="/" class="nav-link">
                <p class="mx-2 mb-0" :class="{ 'active-link': pathname === '/' }">All</p>
            </Link>
            <Link href="/following" class="nav-link">
                <p class="mx-2 mb-0" :class="{ 'active-link': pathname === '/following' }">Following</p>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage} from '@inertiajs/vue3';
import {computed,ref} from 'vue';

    let page=usePage();
    let pathname= ref(page.url);
    // console.log(pathname);
    let username=computed(()=>{
        return page.props.auth.user.username;
    })
</script>

<style>     
    .sub-nav{
        position: sticky;
        top: 0;
        z-index: 2;
        background-color: #fff;
    }
    .sub-nav-container{
        border-bottom: 1px solid #eee;
    }
    .sub-nav .nav-link {
        text-decoration: none;
        color: #999;
        font-weight: bold;
    }
    .active-link{
        color: #000;
        /* font-size: 1.2rem; */
    }
</style>