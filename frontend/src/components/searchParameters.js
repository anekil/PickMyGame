import { create } from "zustand"

export const useParametersStore = create((set) => ({
    title: null,
    players: 2,
    playtime: [10, 20],
    categories: null,
    mechanics: null,
    setTitle : (newValue) => set({title: newValue}),
    setPlayers : (newValue) => set({players: newValue}),
    setPlaytime : (newValue) => set({playtime: newValue}),
    setMechanicsOrCategories : (option, newValue) => {
        if(option === "mechanics")
            set({mechanics: newValue})
        if(option === "categories")
            set({categories: newValue})
    },
    clearStore: () => {
        set(state => ({
            title: null,
            players: 2,
            playtime: [10, 20],
            categories: null,
            mechanics: null,
        }))
    },
}))