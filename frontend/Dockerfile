FROM node:alpine as builder

WORKDIR /frontend

COPY ./package*.json ./
RUN npm install --frozen-lockfile

COPY ./ .
RUN npm run build

FROM node:alpine

WORKDIR /frontend
COPY --from=builder /frontend ./


EXPOSE 3000
CMD ["npm", "start"]
