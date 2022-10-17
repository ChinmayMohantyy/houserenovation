<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_default"
                                v-if="this.fieldAssistantDetails === null">
                                Assign Field Assitant
                            </button>
                            <div v-else>
                                <small><b>Field Assistant</b></small><br />
                                {{this.fieldAssistantDetails.name}}
                            </div>
                        </td>
                        <td>
                            <small><b>Verification Document</b></small>
                            <br />
                            <div >
                                <div v-if="images">
                                    <p v-for="(image,index) in images" :key="index"><a :href="`/verification_documents/${image}`" target="_blank">View Document</a>
                                    </p>
                                </div>
                                <div v-else>
                                     <p>N/a</p>
                                </div>
                               
                                <textarea name="" id="" cols="25" rows="3" v-if="verificationData"
                                    readonly>{{verificationData}}</textarea><br>
                                    <!-- <button type="button"
                                    class="btn btn-success btn-sm" @click="verifyDocument($event)"
                                    v-if="!verifiedAt">Verify</button> -->
                            </div>
                            
                        </td>
                        <td>
                            <small><b>Verified At</b></small><br />
                            <p v-if="verifiedAt">{{verifiedAt}}</p>
                            <p v-else>N/a</p>
                        </td>
                        <td>
                            <small><b>Interested House Captain</b></small><br />
                            <p v-for="(houseimage,index) in housecaptainimages" :key="index">
                                <a :href="`/verification_documents/${houseimage}`" target="_blank"
                                        v-if="houseimage" style="color:red">View Document</a></p>
                            <h3 class="text-primary" v-if="houseCaptainDetails" style="text-transform:uppercase;font-size: 20px;">{{houseCaptainDetails.name}}</h3>
                            <p v-else>N/a</p>
                            <!-- <div v-if="houseCaptainDetails && !this.houseCaptainApprovedAt">
                                <button type="button" class="btn btn-success btn-sm" name="test"
                                    @click="acceptAction($event,'accept')">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    @click="acceptAction($event,'reject')" >Reject</button>
                            </div> -->
                        </td>
                        <td>
                            <small><b>verified House Captain</b></small><br />
                            <p v-if="houseCaptainApprovedAt">{{houseCaptainApprovedAt}}</p>
                            <p v-else>N/a</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Assign Field assistant modal -->
        <div id="modal_default" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Assign Field Assistant</h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="">Choose</label> -->
                            <select name="" id="" class="form-control" v-model="formdata.field_assistant_id">
                                <option value="">Choose...</option>
                                <option v-for="fa in fieldAssitants" :key="fa.id" :value="fa.id">{{fa.name}}</option>
                            </select>
                            <small class="text-danger"
                                v-if="validation_errors.field_assistant_id">{{validation_errors.field_assistant_id[0]}}</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="assignFieldAssitant($event)">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>

      
        <!-- /assign field assitant modal -->
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    props: {
        id: Number,
        fieldAssitants: [],
        fieldAssistantDetails: null,
        houseCaptainApprovedAt: null,
        houseCaptainDetails: null,

        verifiedAt: null,
        verificationDocument: null,
        verificationData: null,
        verificationImage: null
    },
    data() {
        return {
            formdata: {
                id: this.id,
                field_assistant_id: ''
            },
            validation_errors: [],
            images: [],
            housecaptainimages: []
        }
    },
    mounted() {
    },
    created() {
        this.images = this.verificationDocument.split(',');
        this.housecaptainimages = this.verificationImage.split(',');
        console.log(this.images)
        console.log(this.houseCaptainApprovedAt);
        console.log(this.verificationDocument);
    },
    methods: {
        assignFieldAssitant(e) {
            e.target.disabled = true;
            console.log(this.formdata.field_assistant_id)
            Axios.post(`${window.location.origin}/admin/assign-field-assistant`, this.formdata).then((res) => {
                e.target.disabled = false;
                if (res.data.status) {
                    window.location.reload();
                } else {
                    if (res.data.validation_errors) {
                        this.validation_errors = res.data.validation_errors;
                    }
                }
            }).catch((err) => {
                console.log(err);
            })
        },
        verifyDocument(e) {
            Axios.post(`${window.location.origin}/admin/house-repair-request-verify`, {
                id: this.id
            }).then((res) => {
                e.target.disabled = false;
                if (res.data.status) {
                    window.location.reload();
                } else {
                    if (res.data.validation_errors) {
                        this.validation_errors = res.data.validation_errors;
                    }
                }
            })
        },
        acceptAction(e, type) {
            e.target.disabled = true;
            if (type == 'accept') {
                Axios.post(`${window.location.origin}/admin/accept-interested-house-captain`, {
                    id: this.id
                }).then((res) => {
                    e.target.disabled = false;
                    if (res.data.status) {
                        window.location.reload();
                    } else {
                        if (res.data.validation_errors) {
                            this.validation_errors = res.data.validation_errors;
                        }
                    }
                })
            }

            if (type == 'reject') {
                Axios.post(`${window.location.origin}/admin/reject-interested-house-captain`, {
                    id: this.id
                }).then((res) => {
                    e.target.disabled = false;
                    if (res.data.status) {
                        window.location.reload();
                    } else {
                        if (res.data.validation_errors) {
                            this.validation_errors = res.data.validation_errors;
                            // console.log(this.validation_errors)
                        }
                    }
                })
            }
        }
    },

    mounted() {
        console.log(this.fieldAssitants)
        console.log(this.id)
        console.log(this.verifiedAt)
        console.log(this.houseCaptainApprovedAt);
    }
};
</script>
