import Vue from 'vue';

export function notify(message, type = "default", options = {}) {
    Vue.$toast.open({
        message,
        type: type,
        duration: 3000,
        position: 'bottom',
        ...options,
    });
}
