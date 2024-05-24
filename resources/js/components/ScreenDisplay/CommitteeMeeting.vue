<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
});

const setAsNext = (id) => {
  axios.post(`/api/committee-meeting-screen-next/${id}`).then((response) => {
    router.visit(location.href);
  });
};

const setAsPending = (id) => {
  axios.post(`/api/committee-meeting-screen-pending/${id}`).then((response) => {
    router.visit(location.href);
  });
};

const setAsCurrent = (id) => {
  console.log("Set as current", id);
};

const removeFromList = (id) => {
  console.log("Remove from list", id);
};
</script>
<template>
  <div>
    <h5 class="card-title text-dark mb-3">Complete listing of chairmanship</h5>
    <div class="card-text">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">Committee</th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">Chairman</th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">
              Vice Chairman
            </th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">Venue</th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">order</th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">status</th>
            <th class="bg-light text-uppercase fw-bold letter-spacing-1">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="committee in schedule.committees" :key="committee">
            <td class="text-uppercase fw-bold text-primary">
              {{ committee.name }}
            </td>
            <td>
              {{ committee.lead_committee_information?.chairman_information?.fullname }}
            </td>
            <td>
              {{
                committee.lead_committee_information?.vice_chairman_information?.fullname
              }}
            </td>
            <td>
              {{ schedule?.schedule_venue?.name }}
            </td>
            <td>
              {{ committee?.display?.index }}
            </td>
            <td>
              {{ committee?.display?.status }}
            </td>
            <td>
              <button class="btn btn-primary" @click="setAsNext(committee?.display?.id)">
                SET AS NEXT
              </button>
              <button
                class="btn btn-primary"
                @click="setAsPending(committee?.display?.id)"
              >
                SET AS PENDING
              </button>
              <button
                class="btn btn-success"
                @click="setAsCurrent(committee?.display?.id)"
              >
                SET AS CURRENT
              </button>
              <button
                class="btn btn-danger"
                @click="removeFromList(committee?.display?.id)"
              >
                REMOVE FROM LIST
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
