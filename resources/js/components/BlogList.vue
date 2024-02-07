<template>
    <!-- writer-profile-img,name&date -->
    <div class="d-flex">
        <div class="me-2">
            <div v-if="!blog.user.profile_picture" style="width: 35px; height: 35px; border-radius: 50%;"
                class="bg-dark text-white d-flex justify-content-center align-items-center ">
                <h5 class="mb-0">{{ blog.user.name.slice(0, 1) }}</h5>
            </div>
            <img v-else class="user-profile-img" :src="'/storage/' + blog.user.profile_picture" alt="">
        </div>
        <div class="">
            <div class="d-flex">
                <div class="me-2">
                    <p class="mb-0">{{ blog.user.name }}</p>
                </div>
                <div v-if="auth_id != blog.user_id">
                    <Link v-if="isFollowing(blog.user_id)" :href="'/unfollow/' + blog.user_id" method="post" preserve-scroll
                        class="text-decoration-none text-dark fw-bold">. Following</Link>
                    <Link v-else :href="'/follow/' + blog.user_id" method="post" preserve-scroll
                        class="text-decoration-none text-dark fw-bold">. Follow</Link>
                </div>
            </div>
            <span>{{ formatDate(blog.created_at) }}</span>
        </div>
    </div>
    

    <!-- blog-title,body,category,feature-img -->
    <div class="row my-3">
        <div class="col-12">
            <div class="row justify-content-between align-items-center">
                <div class=" col-8 col-md-9">
                    <Link :href="'blogs/' + blog.id" class="text-decoration-none text-dark">
                    <h4 class="fw-bold responsive-font">{{ blog.title }}</h4>
                    <!-- <h6 class="d-block d-sm-none fw-bold responsive-font">{{ blog.title }}</h6> -->
                    </Link>
                    <p class="d-none d-md-block">
                        {{ blog.body }}
                    </p>
                    <div class="mt-4 mt-md-0">
                        <span class="badge bg-secondary me-3">{{ blog.topic }}</span>
                        <!-- <div v-if="blog.comments.length>0" class="">
                                                <span class="text-black-50">{{blog.comments.length}} comments</span>
                                            </div> -->
                    </div>
                </div>
                <div class="col-4 col-md-3 d-flex justify-content-center ">
                    <img class="img ms-1 me-3 me-md-0" :src="getImageUrl(blog.feature_photo)" alt="">
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-5" style="border: 0.1px solid #999;">
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import {computed} from 'vue';

    let props=defineProps({blog:Object})

    let page=usePage()

    let auth_id=computed(()=>{
        return page.props.auth.user.id;
    })

    let followings=computed(()=>{
        return page.props.auth.user.followings;
    })

    let isFollowing=(userId)=>{
        // Check if the user with the given ID exists in the followings array
        if (followings.value) {
                return followings.value.some(following => following.id === userId);
            }
    }
    
    let getImageUrl=(featurePhoto)=>{
        return `storage/feature_images/${featurePhoto}`;
    }

    let formatDate=(value)=>{
        return new Date(value).toLocaleDateString();
    }
</script>

<style>
.responsive-font {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Number of lines to show */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>