<template>
    <table class="table">
        <tbody>
            <tr>
                <th>
                    <div class="form-group" v-if="!verificationDocument">
                        <label for="">Upload Document</label>
                            <input class="form-control" type="file" ref="file" multiple="multiple">
                            <!-- <input
                                                    type="file"
                                                    id="file"
                                                    ref="inputFile"
                                                    class="form-control"
                                                    multiple="multiple"
                                                    v-on:change="handleFileUpload($event)"
                                                   /> -->
                    </div>
                    <div class="form-group" v-if="!verificationDocument">
                        <label for="">About verification</label>
                            <input class="form-control" type="text" name="" id="" v-model="text">
                    </div>
                    <div v-else>
                        <p v-for="(image,index) in images" :key="index"><a :href="`/verification_documents/${image}`" target="_blank">View Document</a></p>
                    </div>
                </th>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" @click="uploadDocument($event)" v-if="!verificationDocument">uploadDocument</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import Axios from 'axios';
export default {
    props: {
        id: Number,
        verificationDocument: null,
    },
    data(){
        return {
            validation_errors: [],
            text:[],
            images: []
        }
    },
    mounted(){
        if(this.verificationDocument){
            this.images = this.verificationDocument.split(',');
            console.log(this.verificationDocument.split(','))
        }  
    },
    methods:{
        uploadDocument(e){
            // e.target.disabled = true;
            // let file = this.$refs.file.files[i];

            let verification_data = this.text;
            let formData = new FormData();

            for( var i = 0; i < this.$refs.file.files.length; i++ ){
                let file = this.$refs.file.files[i];
                formData.append('files[' + i + ']', file);
            }
            formData.append("id", this.id);
            formData.append("verification_data",verification_data);
            console.log(formData);
            Axios.post(`${window.location.origin}/admin/field-assistant/upload-verification-document`,formData)
                    .then(response=>{
                        console.log(response);
                        window.location.reload();
                        this.error={}
                this.$alert("Profile Updated Successfully.");
                            // this.$router.push({  path: '/owner/tickets'})
                            window.location.reload();
                    }).catch(err=>{
                        e.target.disabled = false;
                        if(res.data.status){
                            window.location.reload();
                        }else{
                            if(res.data.validation_errors){
                                this.validation_errors = res.data.validation_errors;
                            }
                        }
                    })

},
    handleFileUpload(event) {
           this.file = event.target.files[0];
           console.log(this.file);
        },
    
}
}
</script>