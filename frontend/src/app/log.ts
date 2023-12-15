export interface Log {
    host: string;
    datetime: LogDateTime;
    request: LogRequest;
    response_code: number;
    document_size: number | null;
  }
  
  export interface LogDateTime {
    day: string;
    hour: string;
    minute: string;
    second: string;
  }
  
  export interface LogRequest {
    method: 'GET' | 'POST' | 'HEAD' | null;
    url: string;
    protocol: 'HTTP' | null;
    protocol_version: '1.0' | null;
  }
  