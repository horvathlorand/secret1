<template>
  <div>
    <h1 class="text-center">Secret api</h1>

    <add-new-secret-modal
      :open-new-secret-modal="openNewSecretModal"
    ></add-new-secret-modal>

    <b-alert 
      class="alert alert-danger" 
      role="alert" 
      :show="dismissCountDown" 
      @dismissed="dismissCountDown=0" 
      dismissible>
      {{ errorText }}
    </b-alert>
    
    <b-form-input 
      v-model="secretHash">
    </b-form-input>
    
    <b-button
      @click="getSecretByHash">
      Get secret
    </b-button>
    
    <div class="pt-4">
      <button 
        type="button" 
        class="btn btn-success" 
        @click="openNewSecretModal = true">
          Új secret hozzáadása
      </button>
    </div>
    
    <div>
      <span v-if="Object.keys(secret).length !== 0">
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
    }
  },
}
</script>