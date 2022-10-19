FROM node
WORKDIR /app
COPY package.json .
RUN npm install
COPY . .
EXPOSE 13000
CMD ["npm", "start"]