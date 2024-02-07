<template>
    <div class="">
        <Navbar :blogs="blogs" @searchBlogs="searchBlogs" @clickProfilePart="clickProfilePart"></Navbar>
        <div class=" container-lg ">
            <div class="row" style="position: relative; top: 80px;">
                <div class="col-md-12 col-lg-8 showAdditionalPart d-lg-block" :class="{'d-none' : additionalPart}">
                    <SubNav></SubNav>
                    <div v-if="hasSearchBlogs">
                        <div v-for="blog in searchBlogsLists" :key="blog.id" class="py-1 px-3 px-sm-4 px-lg-2">

                        <BlogList :blog="blog"/>

                        </div>
                    </div>

                    <div v-else>
                      <div v-for="blog in formattedBlogs" :key="blog.id" class="py-1 px-3 px-sm-4 px-lg-2">
                        <BlogList :blog="blog"/>
                      </div> 
                    </div>
                </div>

                <AdditionalPart :class="{'d-flex' : additionalPart}"
                 :topBlogs="props.topBlogs"  
                 :blogs="props.blogs"
                 :topBloggers="props.topBloggers"
                 />
            </div>

        </div>

        <BotNav @hasAdditionalPart="hasAdditionalPart"/>

        <!-- Profile Part -->
        <ProfilePart/>

    </div>
</template>
  

<script setup>
import SubNav from '../components/SubNav.vue';
import Navbar from '../components/Navbar.vue';
import BotNav from '../components/BotNav.vue';
import ProfilePart from '../components/ProfilePart.vue';
import AdditionalPart from '../components/AdditionalPart.vue';
import BlogList from '../components/BlogList.vue';
import {computed,ref} from 'vue';


    let props= defineProps({ blogs: Object, topBloggers: Array, topBlogs: Array });

    let hasSearchBlogs=ref(false);

    let searchBlogsLists=ref([]);

    let formattedBlogs=computed(()=>{
        return  props.blogs.map(blog => {
                const maxLength = 240;
                blog.body = blog.body.length > maxLength ? blog.body.slice(0, maxLength) + '...' : blog.body;
                // console.log(blog);
                return { ...blog };
            })
    })

    let searchBlogs=(results)=>{
        hasSearchBlogs.value=true;
        searchBlogsLists.value=results; 
        console.log(searchBlogsLists.value);
    }

    let additionalPart=ref(false)

    let hasAdditionalPart=()=>{
        additionalPart.value=true
    }


</script>
  
<style>
.user-profile-img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
}

.category-cloud {
    border-left: 1px solid #eee;
}

.img {
    width: 120px;
    height: 100px;
    object-fit: cover;
    object-position: top;
}

.showAdditionalPart{
    display: block;
}

@media only screen and (max-width: 430px) {
    .img{
        width: 100px;
        height: 80px;
    }
}

@media only screen and (max-width: 330px) {
    .img{
        width: 80px;
        height: 60px;
    }
}

</style>