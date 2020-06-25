<template>
    <div>
        <b-modal v-model="show" hide-footer size="md" centered title="">
            <h3 class="mb-4" style="text-align: center">Create Account</h3>
            <div class="row">
                <div class="col-md-12 p-4">
                        <UserRegister></UserRegister>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import AuthenticationMixin from '@/mixins/AuthenticationMixin'
    import UserRegister from '@/components/Register'

    export default {
        name: "SignUp",
        mixins: [AuthenticationMixin],
        components: {
            UserRegister
        },
        created() {
            this.$eventBus.$on('sign-up', () => this.showSignUp())
            this.$eventBus.$on('user-registered', () => this.hideModal())
        },
        methods: {
            showSignUp() {
                this.show = true
            }
        }
    }
</script>

<style>
    .modal-backdrop.show { background-color: white !important; opacity: 0.9 }
    .modal-header, .modal-footer { border: 3px }
    .modal-content{ boox-shadow: 5px 10px red !important}
</style>