<template>
    <div>
        <b-modal v-model="show" hide-footer size="sm" centered title="">
            <h3 class="mb-4" style="text-align: center">Sign in</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 col-sm-offset-1 float-left">
                        <login @reset-password="resetPassword"></login>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
import AuthenticationMixin from '@/mixins/AuthenticationMixin'
import Login from '@/components/Login'

export default {
    name: "SignIn",
    mixins: [AuthenticationMixin],
    components: {
        Login
    },
    created() {
        this.$eventBus.$on('sign-in', () => this.showSignIn())
        this.$eventBus.$on('user-logged-in', () => this.hideModal())
    },
    methods: {
        showSignIn() {
            this.show = true
        },
        resetPassword() {
            this.hideModal()
            this.$router.push({name: 'send-reset-password-link'})
        }
    }
}

</script>

<style scoped>

</style>