<template>
    <div>
        <b-modal 
            v-model="showNewSecretModal"
            title="New hash create"
            header-bg-variant="secondary"
            ok-title="Save"
            ok-variant="success"
        >
            <b-form-group
                label="Secret text">
                <b-form-input 
                    v-model="secret.secretText">
                </b-form-input>
            </b-form-group>

            <b-form-group
                label="Expires at (minutes)">
                <b-form-input 
                    v-model="secret.expiresAt">
                </b-form-input>
            </b-form-group>
            
            <b-form-group
                label="Expire after views">
                <b-form-input 
                    v-model="secret.remainingViews">
                </b-form-input>
            </b-form-group>
            
            <template #modal-footer>
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="saveSecret"
                >
                    Save
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: {
        openNewSecretModal: Boolean,
    },
    data() {
        return {
            secret: {
                secretText: "",
                expiresAt: "",
                remainingViews: 0,
            },
        }
    },
    computed: {
        showNewSecretModal: {
            get() {
                return this.openNewSecretModal;
            },
            set(value) {
                return value;
            }
        }
    },
    methods: {
        saveSecret() {
            axios.post('/api/secret/save', {
                secretData: this.secret,
            })
            .then(function (response) {
                this.openNewSecretModal = false;
            })
        }
    }
}
</script>