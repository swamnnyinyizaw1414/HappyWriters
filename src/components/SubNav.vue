<template>
   <div class="sub-nav py-3 px-5 bg-white">
        <div class="d-flex align-items-center">
            <router-link to="/" class="nav-link" active-class="active-link">
                <p class="mx-2 mb-0">All</p>
            </router-link>
            <router-link to="/following" class="nav-link" active-class="active-link">
                <p class="mx-2 mb-0">Following</p>
            </router-link>
        </div>
        </div>
</template>

<script>
    export default{
        
    }
</script>

<style>     
    .sub-nav .nav-link{
        text-decoration: none;
        color: #999;
        font-weight: bold;
    }
    .sub-nav .active-link{
        color: #000;
        /* font-size: 1.2rem; */
    }
</style>