<template>
  <div>
    <div class="row">
      <div class="col-md-12" v-if="!addData">
        <!-- <button type="button" class="btn btn-primary" @click="addDataToggle()">Add Data</button> -->
      </div>
    </div>
    <template v-if="addData">
      <div class="row" v-for="(field, i) in inputFields" :key="i">
        <div class="col-md-4">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              v-model="field.name"
              placeholder="Question"
            />
            <small
              class="text-danger"
              v-if="
                validation_errors.length > 0 &&
                validation_errors.field_list[i].name
              "
              >{{ validation_errors.field_list[i].name }}</small
            >
          </div>
        </div>
        <div class="col-md-4">
          <input
            type="text"
            class="form-control"
            v-model="field.value"
            placeholder="Answer"
          />
          <small
            class="text-danger"
            v-if="
              validation_errors.length > 0 &&
              validation_errors.field_list[i].value
            "
            >{{ validation_errors.field_list[i].value }}</small
          >
        </div>
        <div class="col-md-4">
          <a href="#" v-if="i !== 0" @click="removeField(i, $event)"
            ><i class="icon-close2 text-danger"></i
          ></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="#" @click="addNewField($event)"
            ><i class="icon-add"></i> Add New Field</a
          >
        </div>
        <div class="col-md-12 text-center">
          <button
            type="button"
            class="btn btn-primary"
            @click="submitData($event)"
          >
            Save
          </button>
          <a href="#" class="text-danger" @click="closeAddNewDiv($event)">Close</a>
        </div>
      </div>
    </template>
  </div>
</template>
<script>
import Axios from "axios";
export default {
  props: {
    id: Number,
  },
  data() {
    return {
      addData: false,
      validation_errors: [],
      inputFields: [{ name: "", value: "" }],
    };
  },
  methods: {
    addNewField(e) {
      e.preventDefault();
      this.inputFields.push({ name: "", value: "" });
    },
    removeField(i, e) {
      e.preventDefault();
      if (this.inputFields.length > 1) {
        this.inputFields.splice(i, 1);
      }
    },
    addDataToggle(){
        this.addData = !this.addData;
    },
    closeAddNewDiv(){
        window.location.reload();
    },
    submitData(e) {
      e.preventDefault();
      console.log(this.inputFields);
      //   this.inputFields.forEach(function (input) {
      //     if (input.name != '' || input.value != '') {
      //       console.log(input.name + '  ,  ' + input.value);
      //     }
      //   });
      Axios.post(
        `${window.location.origin}/admin/save-custom-data-house-repair-request`,
        {
          field_list: this.inputFields,
          id: this.id,
        }
      ).then((res) => {
        console.log(res.data);
        if (res.data.status) {
          window.location.reload();
        } else {
          if (res.data.validation_errors) {
            console.log("Validation error");
            res.data.validation_errors.forEach((element) => {
              console.log(element);
            });
            // this.validation_errors = res.data.validation_errors;
            // console.log(JSON.stringify(this.validation_errors))
          }
        }
      });
    },
  },
};
</script>