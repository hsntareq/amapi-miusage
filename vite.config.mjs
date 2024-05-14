import { defineConfig } from "vite";
// vite.config.js
export default defineConfig({
	server: {
		port: 3030,
	},
	build: {
		manifest: true,
		assetsDir: './img',
		outDir: 'assets/dist',
		optimizeDeps: {
			include: [
				'src/assets-src/js/admin.js',
				'src/assets-src/js/front.js'
			],
		},
		rollupOptions: {
			input: {
				'admin': '/src/assets-src/js/admin.js',
				'front': '/src/assets-src/js/front.js',
			},
			output: {
				entryFileNames: '[name].js',
				assetFileNames: '[name][extname]',
				chunkFileNames: '[name].min.[extname]',
			},
			refresh: true,
		},
	},

})
