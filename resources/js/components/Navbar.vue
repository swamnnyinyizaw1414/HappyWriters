<template>
  <Nav class="pt-3r" :class="{ 'nav-visible ': isNavVisible }">
    <div class="d-flex px-4 pt-3 pb-0 navbar ">
        <div class="d-flex align-items-center">
            <Link href="/" class="text-decoration-none">
                <h4 class="fw-bold mb-0" ref="" style="color:#fc5185">Happy<span style="color: #000">Writers</span></h4>      
            </Link>
            <input type="text" v-model="keyword" placeholder="Search..." class="d-block ms-2 d-sm-none mx-2 form-control">
        </div>
        <div class="d-flex align-items-center">
            <div v-if="isCreatePage==false" class="d-flex align-items-center justify-content-end ">
                <Link v-if="username" href="/blog/create" class="d-none d-lg-flex mx-2 text-decoration-none text-black">
                    <i class="bi bi-pencil-square me-1"></i>
                    Write
                </Link>
                <input type="text" v-model="keyword" placeholder="Search..." class="d-none d-sm-block mx-2 form-control">
            </div>
            <div v-if="username" class="d-lg-flex d-none" @click="handleProfilePart">
                <div v-if="!currentUserProfilePicture" data-bs-toggle="modal" data-bs-target="#profilePart" style="width: 40px; height: 40px; border-radius: 50%;" class="d-none d-lg-block mx-2 btn btn-outline-dark d-flex justify-content-center align-items-center ">
                    <h5 class="mb-0">{{ username.slice(0, 1) }}</h5>
                </div>
                <img v-else :src="'/storage/'+currentUserProfilePicture" data-bs-toggle="modal" data-bs-target="#profilePart" style="width:40px; height:40px; border-radius: 50%;" class="user-profile mx-2" alt="">
                
                <div class="mx-2">
                    <Link href="/redirect" method="post" class=" btn btn-danger">Logout</Link>
                </div>
            </div>

            <div v-else>
                <div class="mx-2">
                    <Link href="/redirect" class="btn btn-outline-dark d-none d-lg-block">Login / Signup</Link>
                </div>
            </div>
        </div>
        <hr class="w-100 mb-0 h-auto">
    </div>
  </Nav>
</template>

<script setup>
import { Link,usePage } from '@inertiajs/vue3';
import {computed,ref,watch,onMounted} from 'vue';

    let props=defineProps({blogs:Object,isCreatePage:Boolean,});
    let emit=defineEmits(['searchBlogs','clickProfilePart'])
    let keyword=ref('');
    let page=usePage();
    let searchResults=ref([]);

    let username=computed(()=>{
        return page.props.auth.user.username;
    });

    let currentUserProfilePicture=computed(()=>{
        // console.log(page.props.auth.user.currentUserProfilePicture)
        return page.props.auth.user.currentUserProfilePicture;
    })

    watch(()=>keyword.value,()=>{
        let lowerCase=keyword.value.toLowerCase();

        let results= props.blogs.filter(blog=>{
            return blog.title.toLowerCase().includes(lowerCase) ||
            blog.body.toLowerCase().includes(lowerCase) ||
            blog.topic.toLowerCase().includes(lowerCase) 
        });
        searchResults.value=results;
        // console.log(results)
        // console.log(keyword.value);  
        
        emit('searchBlogs',searchResults.value);
    })

    let isNavVisible = ref(true);
    let lastScrollPos = 0;

    onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    });

    const handleScroll = () => {
    let currentScrollPos = window.pageYOffset;

    if (currentScrollPos > lastScrollPos && currentScrollPos > 50) {
        isNavVisible.value = true;
    } else {
        isNavVisible.value = false;
    }

    lastScrollPos = currentScrollPos;
    };

    let handleProfilePart=()=>{
        emit('clickProfilePart',true)
    }

</script>

<style scoped>
    .user-profile{
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
    }
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #ffffff; /* Set your desired background color */
        transition: transform 0.3s ease-in-out;
        z-index: 1001;
    }

    .nav-visible {
        transform: translateY(0);
    }

    @media only screen and (max-width: 430px) {
        .responsive-input{
            width: 50%;
        }
    }
</style>