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
                    type="number"
                    min=0
                    v-model="secret.expiresAt">
                </b-form-input>
            </b-form-group>
            
            <b-form-group
                label="Expire after views">
                <b-form-input 
                    type="number"
                    min=1
                    v-model="secret.remainingViews">
                </b-form-input>
            </b-form-group>
            
            <template #modal-footer>
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="closeModal"
                >
                    Close
                </b-button>
                <b-button
                    variant="success"
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
                remainingViews: "",
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
            .then(response => {
                this.closeModal();
            })
        },
        setSecretToDefault() {
            this.secret = {};
        },
        closeModal() {
            this.setSecretToDefault();
            this.$emit('close-secret-modal');
        },

    }
}
</script>