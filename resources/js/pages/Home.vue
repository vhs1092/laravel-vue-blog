<template>
<div>
    <div class="row">
        <div class="col-lg-6 offset-md-3">
            <div class="row mb-4">
                <ul class="list-group searchBox">
                    <li class="list-group-item search-head">
                        <h6 class="search">Search</h6>
                    </li>
                    <li class="list-group-item">
                        <search placeholder="Search Post"></search>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row xs-column-reverse">
        <div class="col-lg-12">
            <div class="mr-4">
                <blogs></blogs>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Blogs from "@/components/blog/Blogs";

export default {
    name: "Home",
    components: {
        Blogs
    },
    methods: {
        showSignUp() {
            this.$eventBus.signUp();
        },
        showSignIn() {
            this.$eventBus.signIn();
        }
    }
};
</script>

<style scoped>
.searchBox {
    width: 100%;
}
.search-head{
    background: #807e7e;
    color: white;
}
@media only screen and (max-width: 768px) {
    .searchBox {
        margin-left: 5%;
        margin-right: 5%;
    }
}
</style>
