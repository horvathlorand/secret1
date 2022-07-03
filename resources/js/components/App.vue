<template>
  <div>
    <h1 class="text-center">Secret api</h1>

    <add-new-secret-modal
      :open-new-secret-modal="openNewSecretModal"
      v-on:close-secret-modal="closeSecretModal"
    ></add-new-secret-modal>

    <div class="col-12">
      <b-alert 
        class="col-5 offset-3 alert alert-danger" 
        role="alert" 
        :show="dismissCountDown" 
        @dismissed="dismissCountDown=0" 
        dismissible>
        {{ errorText }}
      </b-alert>
    </div>

    <div class="row col-12">
      <b-form-input 
        class="col-3 offset-3"
        v-model="secretHash">
      </b-form-input>
      
      <b-button
        class="col-1 offset-1"
        @click="getSecretByHash">
        Get secret
      </b-button>
    </div>

    <div class="col-9 offset-3" v-if="Object.keys(secret).length !== 0">
      <span>
        <label>
          Secret text: {{ secret.secretText }}
        </label>
        <label>
          Expires at: {{ secret.expiresAt }}
        </label>
        <label>
          Remaining views: {{ secret.remainingViews }}
        </label>
      </span>
    </div>
    
    <div class="pt-4">
      <button 
        type="button" 
        class="btn btn-success col-2 offset-5" 
        @click="openNewSecretModal = true">
          Add new secret
      </button>
    </div>
  </div>
</template>

<script>
import AddNewSecretModal from './AddNewSecretModal.vue';

export default {
  components: {
    AddNewSecretModal,
  },
  data() {
    return {
      openNewSecretModal: false,
      secret: {},
      secretHash: "",
      dismissCountDown: 0,
      errorText: "",
    }
  },
  methods: {
    getSecretByHash() {
      if (!this.secretHash) {
        this.secret = {};
        this.errorText = "Empty secret text! Please fill the input!";
        this.dismissCountDown = 10;
      } else {
        axios.get('/api/secret/' + this.secretHash)
        .then(response => {
          if (Object.keys(response.data).length !== 0) {
            this.secret = response.data;
          } else {
            this.secret = {};
            this.errorText = "No secret was found in the database with this hash!"
            this.dismissCountDown = 10;
          }
        });
      }
    },
    closeSecretModal() {
      this.openNewSecretModal = false;
    },
  },
}
</script>