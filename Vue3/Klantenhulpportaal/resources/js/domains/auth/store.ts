import { User } from "./types";
import { storeModuleFactory } from "../../services/store";
import { getRequest, putRequest } from "../../services/http";
import { computed } from "vue";

const createAdminStore = () => {
    const adminStore = storeModuleFactory<User>('users');
    const adminGetters = {
        admins: computed(() => adminStore.getters.all.value.filter(user => user.is_admin))
    };

    const adminActions = {
        getAllAdmins: async () => {
            const { data } = await getRequest('admins');
            if (!data) return;
            adminStore.setters.setAll(data);
        },

        assignTicketToAdmin: async (ticketId: number, adminId: number) => {
            const { data } = await putRequest(`tickets/${ticketId}/assign`, {
                handler_id: adminId
            });
            return data; 
        }
    }

    return {
        ...adminStore,
        adminGetters,
        adminActions,
    };
};

export const adminStore = createAdminStore();
    

